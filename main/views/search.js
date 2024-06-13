let dltSelected = document.getElementById('dltSelected')
let dltAll = document.getElementById('dltAll')

dltSelected.addEventListener('click', () => {
    let checkboxes = document.querySelectorAll('input[name="select"]:checked');
    let roomsId = []
    checkboxes.forEach(checkboxe => {
        roomsId.push(checkboxe.parentElement.parentElement.querySelector('#room').value)
    })
    let values = Array.from(checkboxes).map(checkbox => checkbox.value);
    fetch('action/resident_action.php', {
        method: 'POST',
        body: new URLSearchParams({
            id: values,
            rooms: roomsId,
            action: "deleteSelected"
        })
    })
        .then(response => {
            if (response.ok) {
                delteMainRecord(values)
                deleteSearchRecord(values)
                totalCount()
                unsetSeatchResults()
            }
            return response.text();
        })
        .then(data => {
            let arr = data.split(" ")
            arr.pop()
            let index = 0
            roomsId.forEach(room => {
                updateFreeSeats(room, arr[index++])
            })

        })
        .catch(error => {
            console.error('Error:', error);
        });
})
dltAll.addEventListener('click', () => {
    let checkboxes = document.querySelectorAll('input[name="select"]');
    let roomsId = []
    checkboxes.forEach(checkboxe => {
        roomsId.push(checkboxe.parentElement.parentElement.querySelector('#room').value)
    })
    let values = Array.from(checkboxes).map(checkbox => checkbox.value);
    fetch('action/resident_action.php', {
        method: 'POST',
        body: new URLSearchParams({
            id: values,
            rooms: roomsId,
            action: "deleteSelected"
        })
    })
        .then(response => {
            if (response.ok) {
                delteMainRecord(values)
                deleteSearchRecord(values)
                totalCount()
                unsetSeatchResults()
            }
            return response.text();
        })
        .then(data => {
            let arr = data.split(" ")
            arr.pop()
            let index = 0
            roomsId.forEach(room => {
                updateFreeSeats(room, arr[index++])
            })
        })
        .catch(error => {
            console.error('Error:', error);
        });
})


document.addEventListener('DOMContentLoaded', function () {
    let resTable = document.getElementById('residentsTable');
    let totalRes = document.getElementById('totalRes');
    let rowCount = resTable.getElementsByTagName('tr').length - 1;
    totalRes.innerHTML = 'Всього записів: ' + rowCount;
});


function delteMainRecord(residentId) {
    let mainTable = document.querySelector('.main')
    let id = mainTable.querySelectorAll('#resident_id')
    residentId.forEach(resident => {
        id.forEach(field => {
            if (field.value == resident) {
                field.parentElement.parentElement.remove()
            }
        })
    })
}

function deleteSearchRecord(deleteId) {
    let table = document.querySelector('.searchResults')
    let ids = table.querySelectorAll('#select')
    console.log(ids)
    ids.forEach(id => {
        if (deleteId.includes(id.value)) {
            id.parentElement.parentElement.remove()
        }
    })
}