async function updateStateSetting(settingId, optionNumber) {
    await fetch('Settings/UpdateStateSetting.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({settingId, optionNumber}),
    }).then(res => res.ok ? window.location.reload(true) : console.log('Error'))
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