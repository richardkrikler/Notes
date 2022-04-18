document.getElementById('rename-folder-modal-box').addEventListener('shown.bs.modal', () => document.getElementById('folder-name').focus())


shortcut.add('Meta+Alt+N', () => bootstrap.Modal.getOrCreateInstance(document.getElementById('create-note-modal-box')).toggle())

document.getElementById('create-note-modal-box').addEventListener('shown.bs.modal', () => document.getElementById('note-title').focus())


shortcut.add('Meta+Up', () => window.location = '/index.php')


document.title = document.querySelector('p').innerHTML