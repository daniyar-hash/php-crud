const tableBlock = document.querySelector('.table-responsive');

tableBlock.addEventListener('click', (e)=>{


if(e.target.classList.contains('page-link')){
    e.preventDefault();
    
    let page = +e.target.dataset.page;

    if(page){

        fetch('actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body:JSON.stringify({page:page})
        })
        .then((response)=>response.text())
        .then((data)=>{   
              
        tableBlock.innerHTML = data;    //  1 вариант
     

                });
        
        }

}


});






const formCity = document.getElementById('addCityForm')
const btnSubmit = document.getElementById('btn-add-submit')

formCity.addEventListener('submit', (e)=>{

    e.preventDefault();
    btnSubmit.textContent = "Saving ...";
    btnSubmit.disabled = true;

    fetch("actions.php", {
        method:'POST',
        body: new FormData(formCity)
    }).then((response)=> response.json())
        .then((data)=>{

            setTimeout(()=>{
                    Swal.fire({
                    icon: data.answer,
                    title: data.answer,
                    html: data?.errors
                });

            if(data.answer ==='success'){
                formCity.reset();
            }

            btnSubmit.textContent = "Save";
            btnSubmit.disabled = false;

            },1000)

  

        })





})


