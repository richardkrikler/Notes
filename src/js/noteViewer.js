showdown.setFlavor('github')
showdown.setOption('simplifiedAutoLink', true)
showdown.setOption('tables', true)
showdown.setOption('ghMentions', false)
showdown.setOption('tasklists', true)

function unescapeHTML(text) {
    return text.replace(/&amp;/g, "&")
        .replace(/&lt;/g, "<")
        .replace(/&gt;/g, ">")
        .replace(/&quot;/g, "\"")
        .replace(/&#39;/g, "'")
}

const noteContentElement = document.getElementById('note-content')
const converter = new showdown.Converter()
noteContentElement.innerHTML = converter.makeHtml(unescapeHTML(noteContentElement.innerHTML))
hljs.highlightAll();

[...noteContentElement.children].filter(e => e.nodeName === 'PRE').forEach(e => e.setAttribute('code-language', e.children[0].classList[0]));

[...noteContentElement.children].filter(e => ['H1', 'H2', 'H3', 'H4', 'H5', 'H6'].includes(e.nodeName)).forEach(e => e.addEventListener('click', () => window.location.href = window.location.pathname + '#' + e.id))

window.addEventListener("beforeprint", () => window.location = '/note/' + getNoteId() + '/print')

shortcut.add('Meta+E', () => window.location = '/note/' + getNoteId() + '/edit')

shortcut.add('Meta+G', () => bootstrap.Modal.getOrCreateInstance(document.getElementById('tocModal')).toggle())

shortcut.add('Meta+Esc', () => {
    if (window.location.href.includes('#')) {
        window.location.href = window.location.href.split('#')[0]
    }
})

function getFolderId() {
    return document.getElementsByClassName('folder-link')[0].href.split('/')[4]
}

shortcut.add('Meta+Up', () => window.location = '/folder/' + getFolderId())


async function nextOrPreviousNote(nextOrPrevious) {
    await fetch('/Note/getNotesFromFolderId.php?folderId=' + getFolderId())
        .then(res => res.json())
        .then(res => {
            const noteArrayPos = res.notes.findIndex(n => n.noteId === Number(getNoteId()))

            if ((noteArrayPos === 0 && nextOrPrevious === 1) || (noteArrayPos === (res.notes.length - 1) && nextOrPrevious === 0)) {
                return
            }

            if (nextOrPrevious === 0) {
                window.location = '/note/' + res.notes[noteArrayPos + 1].noteId
            } else if (nextOrPrevious === 1) {
                window.location = '/note/' + res.notes[noteArrayPos - 1].noteId
            }
        })
}

shortcut.add('Meta+Alt+O', () => nextOrPreviousNote(1))

shortcut.add('Meta+Alt+P', () => nextOrPreviousNote(0))


function getTableOfContents() {
    let toc = '<ul>';
    [...noteContentElement.children].filter(e => ['H1', 'H2', 'H3'].includes(e.nodeName)).forEach((e, i, a) => {
        if (i !== 0) {
            const previousHeadingLevel = a[i - 1].nodeName.split('')[1]
            const currentHeadingLevel = e.nodeName.split('')[1]
            toc += previousHeadingLevel < currentHeadingLevel ? '<ul>' : previousHeadingLevel > currentHeadingLevel ? '</ul>' : ''
        }
        toc += '<li><a href="#' + e.id + '">' + e.innerHTML + '</a></li>'
    })

    return toc + '</ul>'
}

document.getElementsByClassName('note-toc')[0].innerHTML = getTableOfContents()


document.title = document.querySelector('h1').innerHTML
