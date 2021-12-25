window.addEventListener("beforeprint", function () {
    window.location = '/notePrintViewer.php?note=' + getNoteId()
})

shortcut.add('Meta+E', async function () {
    saveYScrollPos('main-element')
    window.location = '/noteEditor.php?note=' + getNoteId()
})

