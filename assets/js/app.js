
// Get ِall rows in numbers table
const numbersRows      = Array.from(document.querySelectorAll('.numbers-table tbody tr'));

// Get Select Boxes
const countrySelectBox = document.querySelector('#country');
const stateSelectBox   = document.querySelector('#state');

// Get Pagination UL
const paginationUl = document.querySelector('.pagination');

// Get Table
const numbersTable = document.querySelector('.numbers-table tbody');

// Get Table Blade
const tableBlade = document.querySelector('.table-blade');

// Fetch Data On Changing Page
paginationUl.addEventListener('click', event => {
    event.preventDefault();
    console.log(event.target.tagName);
    let page = (event.target.tagName == 'SPAN') ? 
        event.target.innerText : event.target.getAttribute('href').split('page=')[1];

    let siblings = document.querySelectorAll('.page-item');
    siblings.forEach(s => s.classList.remove('active'));
    if(event.target.getAttribute('aria-label') != 'Next »') {
        event.target.parentElement.classList.add('active');
    }
    
    fetch_data(page);
});

// Fetch Pagination data for each page
function fetch_data(page) {
    $.ajax({
        url: config.routes.paginationRoute,
        data: { page },
        success: function(response) {
            tableBlade.innerHTML = response;
        }
    });
}

// Observe State SelectBox Value to update numbers table
stateSelectBox.addEventListener('change', event => {
    let state = event.target.value;
    let country = countrySelectBox.value;

    if(state != '') {
        $.ajax({
            type:'POST',
            data: { state, country, _token: config.token },
            url: config.routes.filternumbersRoute,
    
            success: function(response) {
                tableBlade.innerHTML = response;
            },
    
            error: function(error) {
                console.log(error);
            }
        });
    }
    console.log(state, country);
});
