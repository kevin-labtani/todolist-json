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

//drag-drop

