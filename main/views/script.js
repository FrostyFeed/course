let sbmt = document.querySelectorAll('#sbt')
let oldRoom = document.querySelectorAll('#room')
let dltBtn = document.querySelectorAll('#dlt')
let value = 0
let srcFreeRoom = document.getElementById('freeRoom')

oldRoom.forEach(element => {
    element.addEventListener('focus', () => {
        value = element.value
    })
});

srcFreeRoom.addEventListener('click', () => findFreeRoom())
if (sbmt != null) {
    sbmt.forEach(element => {
        element.addEventListener('click', () => edit(element))
    })
}
if (dltBtn != null) {
    dltBtn.forEach(element => {
        element.addEventListener('click', () => deleteResident(element))
    })
}


function edit(element) {
    let arr = makeArr(element)
    fetch('action/resident_action.php', {
        method: 'POST',
        body: new URLSearchParams({
            resident_id: arr[5],
            first_name: arr[0],
            last_name: arr[1],
            date_of_birth: arr[2],
            room_id: arr[3],
            old_room: value == 0 ? arr[3] : value,
            course: arr[4],
            action: "edit"
        })
    })
        .then(respone => {
            if (!respone.ok) {
                room.value = value
            }
            else {
                updateMainRecord(arr)
            }
            return respone.json()
        })
        .then(data => {
            if (value != 0 && value != arr[3]) {
                updateFreeSeats(arr[3], data['newRoom'])
                updateFreeSeats(value, data['oldRoom'])
            }
            value = 0
        })
        .catch(error => {
            let roomCell = element.parentElement.parentElement.querySelector('#room')
            roomCell.value = value
        });

}


function findFreeRoom() {
    let roomId = document.getElementById('room_id_add')
    fetch('action/room_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            action: "findFreeRoom"
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.text()
        })
        .then(data => {
            roomId.value = data
        })
        .catch(error => {
            console.error('Error:', error.message || error);
        });
}


document.addEventListener('DOMContentLoaded', () => {
    totalCount()
});


function totalCount() {
    let resTable = document.getElementById('residentsTable');
    let totalRes = document.getElementById('totalRes');
    let rowCount = resTable.getElementsByTagName('tr').length - 1;
    totalRes.innerHTML = 'Всього записів: ' + rowCount;

}


function updateMainRecord(data) {
    let mainTable = document.querySelector('.main')
    let id = mainTable.querySelectorAll('#resident_id')
    let index = 0
    id.forEach(field => {
        if (field.value == data[5]) {
            let fields = field.parentElement.parentElement.querySelectorAll('.field')
            fields.forEach(field => {
                field.value = data[index++]
            })
        }
    })
}


function makeArr(element) {
    let fields = element.parentElement.parentElement.querySelectorAll('.field')
    let arr = []
    fields.forEach(field => {
        arr.push(field.value)
    })
    return arr
}


function deleteResident(element) {
    let residentId = element.parentElement.parentElement.querySelector('#id')
    let roomId = element.parentElement.parentElement.querySelector('#room')
    fetch('action/resident_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            resident_id: residentId.value,
            room_id: roomId.value,
            action: "delete"
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            } else {
                roomId.parentElement.parentElement.remove()
                totalCount()
                deleteMainRecord(residentId.value)
            }
            return response.text()
        })
        .then(data => {
            updateFreeSeats(roomId.value, data)
            unsetSeatchResults()
        })
        .catch(error => {
            console.error('Error:', error.message || error);
        });
}


function updateFreeSeats(room, seats) {
    let roomsTable = document.querySelector('.rooms')
    let record = findRoomRecord(roomsTable, room)
    let seatsTd = record.parentElement.querySelector('#free_seats')
    seatsTd.innerHTML = seats
}


function findRoomRecord(talbe, room) {
    let records = talbe.querySelectorAll('#number')
    let findRecord = 0
    records.forEach(record => {
        if (parseInt(record.innerHTML) == room) {
            findRecord = record
        }
    })
    return findRecord
}


function deleteMainRecord(id) {
    let mainTable = document.querySelector('.main')
    let idFields = mainTable.querySelectorAll('#resident_id')
    idFields.forEach(field => {
        if (field.value == id) {
            field.parentElement.parentElement.remove()
        }
    })
}


function unsetSeatchResults() {
    let searchResults = document.querySelector('.searchResults')
    let amount = searchResults.querySelectorAll('tr').length
    if (amount == 1) {
        location.reload()
    }
}