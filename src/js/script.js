async function updateStateSetting(settingId, optionNumber) {
    await fetch('Settings/UpdateStateSetting.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({settingId, optionNumber}),
    }).then(res => res.ok ? window.location.reload(true) : console.log('Error'))
}

async function updateBooleanSetting(settingId, bool) {
    await fetch('Settings/UpdateBooleanSetting.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({settingId, bool}),
    }).then(res => res.ok ? '' : console.log('Error'))
}

function getNoteId() {
    return window.location.href.split('/').join('#').split('#').filter(e => !isNaN(e))[1]
}

shortcut.add('Meta+,', () => window.location = '/settings.php')
