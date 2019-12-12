const submit = document.getElementById("submit");
const toDoList = document.getElementById("toDoList");
let checked = [];
//AJAX
fetch('todo.json', {
    'method': 'GET'
}).then(data => data.json()).then(result => {
        const todoData = result;
        let toDo = Array.from(document.getElementsByClassName("toDo"));
        toDo.map(task => {
            let draggedId = task.getAttribute("id");
            task.parentElement.querySelector("#" + draggedId).addEventListener('click', e => {
                const taskId = e.target.getAttribute('id');
                todoData.forEach(todoTask => {
                    if ("check" + todoTask.id == taskId) {
                        if (document.getElementById(taskId).checked == true) {
                            todoTask.completed = true;
                            checked.push(taskId);
                        } else {
                            todoTask.completed = false;
                        }
                    }
                });
                // To make a button submit disabled
                const validation = [];
                for(let i = 0; i < toDo.length; i++) {
                    if (toDo[i].checked == true) {
                        validation.push(task[i]);
                    } 
                }
                if (validation.length == 0) {
                    submit.setAttribute('disabled', 'disabled');
                } else {
                    submit.removeAttribute('disabled');
                    //To sent the JSON to PHP 
                    submit.addEventListener('click', e => {
                        e.preventDefault();
                        let newForm = new FormData();
                        newForm.append("json", JSON.stringify(todoData));
                        fetch("http://localhost/PHP/Projets/todolist-json/ajax.php", {
                            method: "POST", 
                            body: newForm
                        })
                            .then((res) => res.json())
                            //to deplace the element to completed
                            .then((data) => {
                                for(i = 0; i < checked.length; i++){
                                    let remove = document.getElementById("line" + checked[i]);
                                    let newChild = remove;
                                    let completed = document.getElementById("completed");
                                    completed.appendChild(newChild);
                                    newChild.querySelector("input").setAttribute("disabled", "disabled");
                                    // const text = newChild.querySelector("span").innerHTML;
                                    // const span = newChild.querySelector("span");
                                    // const del = document.createElement("del");
                                    // span.appendChild(del);
                                    // del.innerHTML = text;
                                    // span.innerHTML = "";
                                    if (i-1 == checked.length ) {
                                        checked = [];
                                    }
                                }

                            });
                    });
                }
            });
        });
    });

//drag-drop

    //Get elements
let draggables = document.querySelector('.draggable');
console.log(draggables);

    //Start of the movement of an element
function dragStart(e) {
    this.style.opacity = '0.4'; //change style
    dragSrcEl = this; // the element
    e.dataTransfer.effectAllowed = 'move'; 
    e.dataTransfer.setData('text/html', this.innerHTML); //type of element and the content
};

    // it works if the element is over another element where it can be dropped
function dragEnter(e) {
    this.classList.add('over');
}

    //The cursor leaves the element
function dragLeave(e) {
    e.stopPropagation();
    this.classList.remove('over');
}

     //it starts every several mlsec, when the element is over the drop zone 
function dragOver(e) {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
    return false;
}

    //get data of the element and put it in right place
function dragDrop(e) {
    if (dragSrcEl != this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
    }
    return false;
}

    //it works when the action is finished
function dragEnd(e) {
    let listItens = document.querySelectorAll('.draggable');
    [].forEach.call(listItens, function(item) {
    item.classList.remove('over');
    });
    this.style.opacity = '1';
}

function addEventsDragAndDrop(el) {
    el.addEventListener('dragstart', dragStart, false);
    el.addEventListener('dragenter', dragEnter, false);
    el.addEventListener('dragover', dragOver, false);
    el.addEventListener('dragleave', dragLeave, false);
    el.addEventListener('drop', dragDrop, false);
    el.addEventListener('dragend', dragEnd, false);
}

    //to take elements to use in a function
let listItens = document.querySelectorAll('.draggable');
[].forEach.call(listItens, function(item) {
    addEventsDragAndDrop(item);
});