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
