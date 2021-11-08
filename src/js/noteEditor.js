const contentTextarea = {
    element: document.getElementById('content-textarea'),
    insertText(sStartTag, sEndTag) {
        const bDouble = arguments.length > 1, oMsgInput = this.element, nSelStart = oMsgInput.selectionStart,
            nSelEnd = oMsgInput.selectionEnd, sOldText = oMsgInput.value
        oMsgInput.value = sOldText.substring(0, nSelStart) + (bDouble ? sStartTag + sOldText.substring(nSelStart, nSelEnd) + sEndTag : sStartTag) + sOldText.substring(nSelEnd)
        oMsgInput.setSelectionRange(bDouble || nSelStart === nSelEnd ? nSelStart + sStartTag.length : nSelStart, (bDouble ? nSelEnd : nSelStart) + sStartTag.length)
        oMsgInput.focus()
    },
    getSelectedText() {
        const oMsgInput = this.element
        return oMsgInput.value.substring(oMsgInput.selectionStart, oMsgInput.selectionEnd)
    },
    ifTextSelected() {
        return this.element.selectionStart !== this.element.selectionEnd
    },
    insertAtKeyPressAfterSelection(sEndTag) {
        contentTextarea.insertText('', contentTextarea.getSelectedText() + sEndTag)
    }
}

setInterval(saveNote, 5000)

async function saveNote() {
    if (!saveNoteBt.classList.contains('unsaved')) {
        return
    }

    await fetch('Note/SaveNote.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({noteId: getNoteId(), content: contentTextarea.element.value}),
    }).then(() => saveNoteBt.classList.remove('unsaved'));
}

const startPageTitle = document.title
const saveNoteBt = document.getElementById('saveNote')
const autocompleteElements = [['(', ')'], ['{', '}'], ['[', ']'], ['"', '"'], ['\'', '\'']]
const selectionBasedAutocomplete = [['*', '*'], ['_', '_']]
const modifierKeys = ['Ctrl', 'Alt', 'Shift', 'Meta']

function editorHelper(event) {
    if (!modifierKeys.includes(event.key)) {
        saveNoteBt.classList.add('unsaved')
    }

    if (contentTextarea.ifTextSelected()) {
        autocompleteElements.forEach(e => {
            if (event.key === e[0]) {
                contentTextarea.insertAtKeyPressAfterSelection(e[1])
            }
        });
        selectionBasedAutocomplete.forEach(e => {
            if (event.key === e[0]) {
                contentTextarea.insertAtKeyPressAfterSelection(e[1])
            }
        });
    } else {
        autocompleteElements.forEach(e => {
            if (event.key === e[0]) {
                contentTextarea.insertText('', e[1])
            }
        });
    }
}

async function viewer() {
    await saveNote()
    window.location = '/noteViewer.php?note=' + getNoteId()
}

shortcut.add('Meta+K', function () {
    contentTextarea.insertText('*', '*')
}, {
    'target': contentTextarea.element
})

shortcut.add('Meta+B', function () {
    contentTextarea.insertText('**', '**')
}, {
    'target': contentTextarea.element
})

shortcut.add('Meta+Alt+C', function () {
    contentTextarea.insertText('```', '\n```')
}, {
    'target': contentTextarea.element
})

shortcut.add('Meta+S', async function () {
    await saveNote()
})

shortcut.add('Tab', async function () {
    contentTextarea.insertText('  ')
}, {
    'target': contentTextarea.element
})

shortcut.add('Meta+E', async function () {
    await viewer()
})

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