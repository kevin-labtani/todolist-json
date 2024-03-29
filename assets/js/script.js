const submit = document.getElementById("submit");
const toDoList = document.getElementById("toDoList");
let checked = [];
let toDo = Array.from(document.getElementsByClassName("toDo"));
toDo.map(task => {
  task.addEventListener("click", e => {
    fetch("todo.json", {
      method: "GET"
    })
      .then(data => data.json())
      .catch(error => console.error(error))
      .then(result => {
        const todoData = result;
        const taskId = e.target.getAttribute("id");
        todoData.forEach(todoTask => {
          if ("check" + todoTask.id == taskId) {
            //add a status complited true
            if (document.getElementById(taskId).checked == true) {
              todoTask.completed = true;
              //Check if the element is not in the array to validate the button submit, if not add the element in the array
              if (checked.indexOf(taskId) === -1) {
                checked.push(taskId);
              }
              //add a status complited false
            } else if (document.getElementById(taskId).checked == false) {
              todoTask.completed = false;
              //Check if the element is in the array to validate the button submit, if yes,to delete the element from the array
              if (checked.indexOf(taskId) >= 0) {
                let index = checked.indexOf(taskId);
                checked.splice(index, 1);
              }
            }
          }
        });
        // To make a button submit disabled
        if (checked.length == 0) {
          submit.setAttribute("disabled", "disabled");
        } else {
          submit.removeAttribute("disabled");
        }
        //To sent the JSON to PHP
        submit.addEventListener("click", e => {
          e.preventDefault();
          let newForm = new FormData();
          newForm.append("json", JSON.stringify(todoData));
          fetch("ajax.php", {
            method: "POST",
            body: newForm
          })
            .then(res => res.json())
            .catch(error => console.error(error))
            //to deplace the element to completed
            .then(data => {
              for (i = 0; i < checked.length; i++) {
                //get the completed task
                let completedTask = document.getElementById(
                  "line" + checked[i]
                );
                //get the completed area
                let completed = document.getElementById("completed");
                //add the completed task
                completed.appendChild(completedTask);
                //change style of the completed
                completedTask
                  .querySelector("input")
                  .setAttribute("disabled", "disabled");
                completedTask
                  .querySelector("span")
                  .setAttribute("style", "text-decoration: line-through;");
                //Check if there is no comleted tasks in the array, if true clean - the array
                let indexOfcompTask = checked.indexOf(checked[i]);
                checked.splice(indexOfcompTask, 1);
                if (checked.length == 0) {
                  submit.setAttribute("disabled", "disabled");
                } else {
                  submit.removeAttribute("disabled");
                }
              }
            })
            .catch(error => console.error(error));
        });
      })
      .catch(error => console.error(error));
  });
});

//drag-drop

//Get elements
let draggables = document.querySelector(".draggable");

//Start of the movement of an element
function dragStart(e) {
  let list = document.getElementById("toDoList");
  let tasksToDo = Array.from(list.querySelectorAll("input"));
  let idThis;
  tasksToDo.forEach(task => {
    task.checked = false;
    idThis = task.getAttribute("id");
    for (let i = 0; i < checked.length; i++) {
      if (idThis == checked[i]) {
        let ind = checked.indexOf(idThis);
        checked.splice(ind, 1);
      }
    }
    if (checked.length == 0) {
      submit.setAttribute("disabled", "disabled");
    } else {
      submit.removeAttribute("disabled");
    }
  });

  this.style.opacity = "0.4"; //change style
  dragSrcEl = this; // the element
  e.dataTransfer.effectAllowed = "move";
  e.dataTransfer.setData("text/html", this.innerHTML); //type of element and the content
}

// it works if the element is over another element where it can be dropped
function dragEnter(e) {
  this.classList.add("over");
}

//The cursor leaves the element
function dragLeave(e) {
  e.stopPropagation();
  this.classList.remove("over");
}

//it starts every several mlsec, when the element is over the drop zone
function dragOver(e) {
  e.preventDefault();
  e.dataTransfer.dropEffect = "move";
  return false;
}

//get data of the element and put it in right place
function dragDrop(e) {
  if (dragSrcEl != this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData("text/html");
  }
  return false;
}

//it works when the action is finished
function dragEnd(e) {
  this.previousElementSibling.removeAttribute("disabled");
  let listItens = document.querySelectorAll(".draggable");
  [].forEach.call(listItens, function(item) {
    item.classList.remove("over");
  });
  this.style.opacity = "1";
}

function addEventsDragAndDrop(el) {
  el.addEventListener("dragstart", dragStart, false);
  el.addEventListener("dragenter", dragEnter, false);
  el.addEventListener("dragover", dragOver, false);
  el.addEventListener("dragleave", dragLeave, false);
  el.addEventListener("drop", dragDrop, false);
  el.addEventListener("dragend", dragEnd, false);
  el.addEventListener("mousedown", e => {
    // get JSON
    fetch("todo.json", {
      method: "GET"
    })
      .then(data => data.json())
      .catch(error => console.error(error))
      .then(result => {
        const data = result;
        //get the task of the movable element
        let textOfmovableTask = el.innerHTML;
        //get the id of the movable element
        let idOfmovableTask = el.getAttribute("id");
        //get data of the InDrop p
        el.addEventListener("dragend", e => {
          //get the text of the InDrop p
          textOfDropParagraph = document.getElementById(idOfmovableTask)
            .innerHTML;
          //get the all elemnts of the InDrop zone
          let todoArea = document.getElementById("toDoList");
          let spans = Array.from(todoArea.querySelectorAll("span"));
          //get the id of the InDrop p
          for (let i = 0; i < spans.length; i++) {
            if (spans[i]["innerHTML"] == textOfmovableTask) {
              idOfDropParagraph = spans[i]["id"];
            }
          }
          //Change of JSON
          for (let i = 0; i < data.length; i++) {
            if (data[i]["id"] == idOfmovableTask) {
              data[i]["task"] = textOfDropParagraph;
            } else if (data[i]["id"] == idOfDropParagraph) {
              data[i]["task"] = textOfmovableTask;
            }
          }
          //sent new JSON
          let newFormData = new FormData();
          newFormData.append("json", JSON.stringify(data));
          fetch("ajax.php", {
            method: "POST",
            body: newFormData
          });
        });
      })
      .catch(error => console.error(error));
  });
}

//to take elements to use in a function
let listItens = document.querySelectorAll(".draggable");
[].forEach.call(listItens, function(item) {
  addEventsDragAndDrop(item);
});
