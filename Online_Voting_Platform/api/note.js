showNotes();
// if user click takes notes, add it to localstorage
let addbtn = document.getElementById('addbtn');
addbtn.addEventListener('click', function (e) {
    let addtxt = document.getElementById('addtxt');
    let notes = localStorage.getItem('notes');
    if (notes == null) {
        notesObj = [];
    } else {
        notesObj = JSON.parse(notes);
    }
    notesObj.push(addtxt.value);
    localStorage.setItem('notes', JSON.stringify(notesObj));
    addtxt.value = "";
    showNotes();
})
//function that takes notes from local storage
function showNotes() {
    let notes = localStorage.getItem('notes');
    if (notes == null) {
        notesObj = [];
    } else {
        notesObj = JSON.parse(notes);
    }
    let html = "";
    notesObj.forEach(function (element, index) {
        html += `
                <div class="noteCard my-2 mx-2" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">Problem ${index + 1}</h5>
                <p class = "card-text">${element}</p>
                <button class="btn btn-primary" id ="${index}" onclick = 'deleteNote(this.id)'>Delete Problem if Resolved</button>
                </div>
            </div>
            `;
    });
    let notesElm = document.getElementById('notes');
    if (notesObj.length != 0) {
        notesElm.innerHTML = html;
    }
    else (
        notesElm.innerHTML = `<b></b>`
    )
}

// function for deleteNote
function deleteNote(index) {
    let notes = localStorage.getItem('notes');
    if (notes == null) {
        notesObj = [];
    } else {
        notesObj = JSON.parse(notes);
    }
    notesObj.splice(index, 1);
    localStorage.setItem('notes', JSON.stringify(notesObj));
    showNotes();
}
// for search
let search = document.getElementById('searchTxt');
search.addEventListener('input',function(){
    let inputVal= search.value.toLowerCase();
    console.log(inputVal)
    let noteCards = document.getElementsByClassName('noteCard');
    Array.from(noteCards).forEach(function(element){
        let cardTxt =element.getElementsByTagName('p')[0].innerText;
        console.log(cardTxt);
        if(cardTxt.includes(inputVal)){
            element.style.display="block";
        }else{
            element.style.display= "none";
        }
    })
})
