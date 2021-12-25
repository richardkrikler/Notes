window.addEventListener("beforeprint", function () {
    window.location = '/note/' + getNoteId() + '/print'
})

shortcut.add('Meta+E', async function () {
    saveYScrollPos('main-element')
    window.location = '/note/' + getNoteId() + '/edit'
})

function getTableOfContents() {
    let toc = '<ul>';
    [...document.getElementById('note-content').children].filter(e => ['H1', 'H2', 'H3'].includes(e.nodeName)).forEach((e, i, a) => {
        if (i !== 0) {
            const previousHeadingLevel = a[i - 1].nodeName.split('')[1]
            const currentHeadingLevel = e.nodeName.split('')[1]
            toc += previousHeadingLevel < currentHeadingLevel ? '<ul>' : previousHeadingLevel > currentHeadingLevel ? '</ul>' : ''
        }
        toc += '<li><a href="#' + e.id + '">' + e.innerHTML + '</a></li>'
    })

    return toc + '</ul>'
}

window.addEventListener('load', () => {
    document.getElementsByClassName('note-toc')[0].innerHTML = getTableOfContents()
})
