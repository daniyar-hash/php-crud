const tableBlock = document.querySelector('.table-responsive');

// pagination

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


// get city for edit

    if(e.target.classList.contains("btn-edit")){

        let btnId = +e.target.dataset.id;

        if(btnId){
            
            fetch("actions.php", {
                method: "POST",
                body: JSON.stringify({id:btnId, action:"get_city"})
            })
            .then((response) => response.json())
            .then((data) => {


                if(data.answer ==='success'){
               
                    document.getElementById('editName').value = data.rowCity.name;
                    document.getElementById('editPopulation').value = data.rowCity.population;
                    document.getElementById('id').value = data.rowCity.id;

                }

            })    
      
        }


    }
  
    //  delete city

    if(e.target.classList.contains("btn-delete")){


        // console.log('dfdfdf')

        let btnId = +e.target.dataset.id;

        if(btnId){

            fetch("actions.php", {
                method: "POST",
                body: JSON.stringify({id:btnId, action: 'delete_city'})
            })
            .then((response) => response.json())
            .then((data) => {

            
                    setTimeout(() => {
                            Swal.fire({
                                icon: data.answer,
                                title: data.answer,
                                html: data?.errors
                            });
                            if (data.answer === 'success') {
                               let trTable =  document.getElementById(`city-${btnId}`);
                                trTable.remove();
                            }
                        }, 1000);

                   
                
            })

        }

    }



});


// search 

const searchField = document.getElementById("search");
const preLoader = document.getElementById("loader");

searchField.addEventListener("input", (e)=>{

    let word = e.target.value.trim();

    if(word.length > 2){

          console.log("aaa")
             preLoader.style.display = "block";
        fetch("actions.php", {
            method:"POST",
            body: JSON.stringify({search:word})
        })
        .then((response) => response.text())
        .then((data) => {
            //  preLoader.style.display = "block";
            tableBlock.innerHTML = data;
            setTimeout(()=>{

                let instance = new Mark(tableBlock);
                instance.mark(word);
                preLoader.style.display = "none";


            },500)
        })
    }


})





// add City

const addFormCity = document.getElementById('addCityForm')
const btnAddSubmit = document.getElementById('btn-add-submit')

addFormCity.addEventListener('submit', (e)=>{

    e.preventDefault();
    btnAddSubmit.textContent = "Saving ...";
    btnAddSubmit.disabled = true;

    fetch("actions.php", {
        method:'POST',
        body: new FormData(addFormCity)
    }).then((response)=> response.json())
        .then((data)=>{

            setTimeout(()=>{
                    Swal.fire({
                    icon: data.answer,
                    title: data.answer,
                    html: data?.errors  // страховка на случай если сервер упадет с ошибкой, 
                    // в случае success html:data.errors -undefined без текста внутри
                });

            if(data.answer ==='success'){
                addFormCity.reset();
            }

            btnAddSubmit.textContent = "Save";
            btnAddSubmit.disabled = false;

            },1000)

  

        })

})


// edit city


const editCityForm = document.getElementById("editCityForm");
const btnEditSubmit = document.getElementById("btn-edit-submit");

editCityForm.addEventListener("submit", (e) =>{
    e.preventDefault();
    btnEditSubmit.textContent = "Saving ...";
    btnEditSubmit.disabled = true;

    fetch("actions.php", {
        method: "POST",
        body: new FormData(editCityForm)
    })
    .then((response)=>response.json())
    .then((data) =>{
 
              setTimeout(()=>{
                    Swal.fire({
                    icon: data.answer,
                    title: data.answer,
                    html: data?.errors  // страховка на случай если сервер упадет с ошибкой, 
                    // в случае success html:data.errors -undefined без текста внутри
                });

            if(data.answer ==='success'){

                let idValue = document.getElementById("id").value;
                let name = document.getElementById("editName").value;
                let population = document.getElementById("editPopulation").value;

                let trTable = document.getElementById(`city-${idValue}`);

                trTable.querySelector('.cityName').innerHTML = name;
                trTable.querySelector('.populationCity').innerHTML = population;

              
            }

            btnEditSubmit.textContent = "Save";
            btnEditSubmit.disabled = false;

            },1000)
    })
})


const clearField = document.getElementById("clear-search");
clearField.addEventListener("click", (e) =>{
    console.log("sfsff")
    searchField.value = '';
    fetch("actions.php", {
        method:"POST",
        body:JSON.stringify({page:1})
    })
    .then((response) => response.text())
    .then((data)=>{
        tableBlock.innerHTML = data;
    })

})







