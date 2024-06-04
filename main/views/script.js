let sbmt = document.getElementById('sbt')
sbmt.addEventListener('click', () => edit());
function edit() {
    let room = document.getElementById('room')
    let date = document.getElementById('date')
    let frstName = document.getElementById('first_name')
    let lstName = document.getElementById('last_name')
    let rsdntId = document.getElementById('resident_id')
    fetch('action/resident_action.php', {
        method: 'POST',
        body: new URLSearchParams({
            resident_id: rsdntId.value,
            first_name: frstName.value,
            last_name: lstName.value,
            date_of_birth: date.value,
            room_id: room.value,
            action: "edit"
        })
    })
        .then(response => response.text())
        .then(data => {
            console.log('Response from server:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
