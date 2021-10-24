
const modalBoxes = {
    elements: Array.from(document.getElementsByClassName('modal-box')),
    setInvisible() {
        modalBoxes.elements.forEach(modalBox => modalBox.classList.remove('visible'))
    }
}

modalBoxes.elements.forEach(e => e.addEventListener('click', function (){
    console.log(e)
    console.log(e.classList.remove('visible'))
    e.classList.remove('visible')
}))

window.addEventListener('keydown', (e) => {
    if (e.code === 'Escape') modalBoxes.setInvisible()
})

const cancelModalBoxes = document.getElementsByClassName('cancel-modal-box')
Array.from(cancelModalBoxes)
    .forEach(cancelModalBox =>
        cancelModalBox.addEventListener('click', () => {
            console.log("test")
            modalBoxes.setInvisible();
        }))

const addFolderIcon = document.getElementsByClassName('add-folder-icon')
const addFolderModalBox = document.getElementById('add-folder-modal-box')
Array.from(addFolderIcon).forEach(e => e.addEventListener('click', () => addFolderModalBox.classList.add('visible')))
