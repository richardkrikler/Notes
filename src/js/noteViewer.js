window.addEventListener("beforeprint", function () {
    window.location = '/notePrintViewer.php?note=' + getNoteId()
})

shortcut.add('Meta+E', async function () {
    window.location = '/noteEditor.php?note=' + getNoteId()
})