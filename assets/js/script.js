const submit = document.getElementById("submit");
const toDoList = document.getElementById("toDoList");

//AJAX
fetch('todo.json', {
    'method': 'GET'
}).then(data => data.json()).then(result => {
    const todoData = result;
        let toDo = Array.from(document.getElementsByClassName("toDo"));
        toDo.map(task => {
            task.addEventListener('click', e => {
                const taskId = e.target.getAttribute('id');
                todoData.forEach(todoTask => {
                    if (todoTask.id == taskId) {
                        if (document.getElementById(taskId).checked == true) {
                            todoTask.completed = true;
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
                        fetch("contenu.json", {method: "POST", body: newForm})
                            .then((res) => res.text())
                            .then((data) => console.log(data));
                    });
                }
            });
        });
    });

//drag-drop

    //Get elements
// let draggables = document.querySelector('.draggable');

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