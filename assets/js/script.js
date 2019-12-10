// To make a button submit disabled
const toDo = Array.from(document.getElementsByClassName("toDo"));
const submit = document.getElementById("submit");
toDo.map(task => {
    task.addEventListener('click', e => {
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
        }
    });
});

submit.addEventListener('click', e => {

});

//drag-drop

    //Get elements
let draggables = document.querySelector('.draggable');

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

    //The cursor leave the element
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

    //get data of element and put them in right place
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

    //take elements to use in a function
let listItens = document.querySelectorAll('.draggable');
[].forEach.call(listItens, function(item) {
    addEventsDragAndDrop(item);
});