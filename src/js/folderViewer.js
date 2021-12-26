shortcut.add('Meta+Alt+N', () => bootstrap.Modal.getOrCreateInstance(document.getElementById('create-folder-modal-box')).toggle())

document.getElementById('create-folder-modal-box').addEventListener('shown.bs.modal', () => document.getElementById('folder-name').focus())
