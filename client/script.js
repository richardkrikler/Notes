const modalBoxes = document.getElementsByClassName('modal-box')
Array.from(modalBoxes).forEach(e => e.addEventListener('click', (e) => e.target.classList.remove('visible')))

window.addEventListener('keydown', (e) => {
  if (e.code === 'Escape') Array.from(modalBoxes).forEach(modalBox => modalBox.classList.remove('visible'))
})

const cancelModalBoxes = document.getElementsByClassName('cancel-modal-box')
Array.from(cancelModalBoxes).forEach(e => e.addEventListener('click', (e) => Array.from(modalBoxes).forEach(e => e.classList.remove('visible'))))

const addFolderIcon = document.getElementsByClassName('add-folder-icon')
const addFolderModalBox = document.getElementById('add-folder-modal-box')
Array.from(addFolderIcon).forEach(e => e.addEventListener('click', () => addFolderModalBox.classList.add('visible')))


