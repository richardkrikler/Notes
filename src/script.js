const contentTextarea = {
    element: document.getElementById('content-textarea'),
    insertText(sStartTag, sEndTag) {
        const bDouble = arguments.length > 1, oMsgInput = this.element, nSelStart = oMsgInput.selectionStart,
            nSelEnd = oMsgInput.selectionEnd, sOldText = oMsgInput.value
        oMsgInput.value = sOldText.substring(0, nSelStart) + (bDouble ? sStartTag + sOldText.substring(nSelStart, nSelEnd) + sEndTag : sStartTag) + sOldText.substring(nSelEnd)
        oMsgInput.setSelectionRange(bDouble || nSelStart === nSelEnd ? nSelStart + sStartTag.length : nSelStart, (bDouble ? nSelEnd : nSelStart) + sStartTag.length)
        oMsgInput.focus()
    }
}

async function updateStateSetting(settingId, optionNumber) {
    await fetch('Settings/UpdateStateSetting.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({settingId, optionNumber}),
    }).then(res => res.ok ? window.location.reload(true) : console.log('Error'))
}

async function saveFileFromUrl(event, value) {
    if (event.key !== 'Enter') {
        return
    }

    await fetch(value).then(res => res.blob())
        .then(blob => {
            const reader = new FileReader();
            reader.onload = function () {
                saveFile(this.result)
            }
            reader.readAsDataURL(blob)
        })
}

async function saveFileFromInput(event) {
    const selectedFile = event.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(selectedFile);
    reader.onload = function () {
        saveFile(reader.result)
    };
}

async function saveFile(data) {
    data = data.substr(22)

    const today = new Date();
    const twoDigitStr = input => (input).toLocaleString(undefined, {minimumIntegerDigits: 2})
    const dateString = twoDigitStr(today.getDate()) + "-" +
        twoDigitStr(today.getMonth() + 1) + "-" +
        today.getFullYear() + "_" +
        twoDigitStr(today.getHours()) + "-" +
        twoDigitStr(today.getMinutes()) + "-" +
        twoDigitStr(today.getSeconds());
    const name = "image_" + dateString;

    await fetch("File/CreateFile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({name, data}),
    }).then(() => {
        contentTextarea.insertText('![' + name + '](/File/viewer.php?name=' + name + ')')
    });
}


// if (!res.ok || !(new RegExp('image/*').test(res.headers.get('content-type')))) {
//     return
// }