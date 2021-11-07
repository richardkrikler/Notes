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
    await fetch('Note/SaveNote.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({noteId: getNoteId(), content: contentTextarea.element.value}),
    }).then(() => saveNoteBt.classList.remove('unsaved'))
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

    autocompleteElements.forEach(e => {
        if (event.key === e[0]) {
            contentTextarea.insertText('', e[1])
        }
    });

    if (contentTextarea.ifTextSelected()) {
        selectionBasedAutocomplete.forEach(e => {
            if (event.key === e[0]) {
                contentTextarea.insertAtKeyPressAfterSelection(e[1])
            }
        });
    }
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
    console.log('h')
}, {
    'target': contentTextarea.element
})

shortcut.add('Meta+S', async function () {
    await saveNote()
}, {
    'target': contentTextarea.element
})

shortcut.add('Tab', async function () {
    contentTextarea.insertText('\t')
}, {
    'target': contentTextarea.element
})
