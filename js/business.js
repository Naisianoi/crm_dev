/*-------------Add Modal Business form button click---------------*/
$('#btn').on('click', function(){
    $('#businessmodal').modal('show');
  });

/*------------Add Modal Business form button click----------------*/

/*----------------------reset form after form submission-------------------------------------*/
var btnClear = document.querySelector('button');
var inputs = document.querySelectorAll('input');


btnClear.addEventListener('click', () => {
    inputs.forEach(input =>  input.value = '');
});
/*----------------------reset form after form submission-------------------------------------*/

/*-------------------------------add(get function)--------------------------------------------------*/
$(document).ready(function () {
    getdata();

    $('.ad_ajax').click(function (e) {
        e.preventDefault();

        var business = $('.business').val();
        var brand = $('.brand').val();

        //console.log(brand);
    });
});

/*-------------------------------add(get function)------------------------------------------------*/