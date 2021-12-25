window.addEventListener("beforeprint", function () {
    window.location = '/note/' + getNoteId()
})

shortcut.add('Meta+E', async function () {
    saveYScrollPos('main-element')
    window.location = '/note/' + getNoteId() + '/edit'
})

