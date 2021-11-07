async function saveFile(data) {
    data = data.substr(22)

    const today = new Date()
    const twoDigitStr = input => (input).toLocaleString(undefined, {minimumIntegerDigits: 2})
    const dateString = twoDigitStr(today.getDate()) + "-" +
        twoDigitStr(today.getMonth() + 1) + "-" +
        today.getFullYear() + "_" +
        twoDigitStr(today.getHours()) + "-" +
        twoDigitStr(today.getMinutes()) + "-" +
        twoDigitStr(today.getSeconds())
    const name = "image_" + dateString

    await fetch("File/CreateFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({name, data}),
    }).then(() => {
        contentTextarea.insertText('![' + name + '](/File/viewer.php?name=' + name + ')')
    })
}


async function saveFileFromUrl(event, value) {
    if (event.key !== 'Enter') {
        return
    }

    await fetch(value).then(res => res.blob())
        .then(blob => {
            const reader = new FileReader()
            reader.onload = function () {
                saveFile(this.result)
            }
            reader.readAsDataURL(blob)
        })
}

async function saveFileFromInput(event) {
    const selectedFile = event.target.files[0]
    const reader = new FileReader()
    reader.readAsDataURL(selectedFile)
    reader.onload = function () {
        saveFile(reader.result)
    }
}

window.addEventListener("beforeprint", function (event) {
    window.location = '/notePrintViewer.php?note=' + getNoteId()
})