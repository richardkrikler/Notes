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

function getNoteId() {
    if ((window.location.href).indexOf('?') !== -1) {
        const queryString = (window.location.href).substr((window.location.href).indexOf('?') + 1)
        const queryStringAr = queryString.split('=')
        if (queryStringAr[0] === 'note') {
            return queryStringAr[1]
        }
    }
}

window.addEventListener("beforeprint", function (event) {
    window.location = '/notePrintViewer.php?note=' + getNoteId()
})

setInterval(saveNote, 5000)

async function saveNote() {
    await fetch('Note/SaveNote.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({noteId: getNoteId(), content: contentTextarea.element.value}),
    }).then(() => saveNoteBt.classList.remove('unsaved'))
}

const startPageTitle = document.title
const saveNoteBt = document.getElementById('saveNote')
const insertableElements = [['(', ')'], ['{', '}'], ['[', ']'], ['*', '*'], ['_', '_']]
const modifierKeys = ['Ctrl', 'Alt', 'Shift', 'Meta']

function editorHelper(event) {
    if (!modifierKeys.includes(event.key)) {
        saveNoteBt.classList.add('unsaved')
    }

//    if (event.key.altKey && event.key === 'b') { // not working
//        contentTextarea.insertText('*', '*')
//        return
//    }

    if (contentTextarea.ifTextSelected()) {
        insertableElements.forEach(e => {
            if (event.key === e[0]) {
                contentTextarea.insertAtKeyPressAfterSelection(e[1])
            }
        })
    }
}

shortcut.add("Meta+Alt+K", function () {
    contentTextarea.insertText('*', '*')
}, {
    'propagate': true,
    'target': contentTextarea.element
})

shortcut.add("Meta+Alt+B", function () {
    contentTextarea.insertText('**', '**')
}, {
    'propagate': true,
    'target': contentTextarea.element
})

shortcut.add("Meta+Alt+S", async function () {
    await saveNote()
}, {
    'propagate': true,
    'target': contentTextarea.element
})
