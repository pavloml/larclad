/**
 * Creates a user activity log table
 * @param {Array} data
 * @return {HTMLTableElement}
 */
window.createActivityTable = (data) => {
    const activityTable = document.createElement('table');
    activityTable.classList.add('table');

    const headRow = document.createElement('tr');
    const dataRows = [];

    const headTimeCell = document.createElement('th');
    const headTypeCell = document.createElement('th');
    const headIpCell = document.createElement('th');
    const headDeviceCell = document.createElement('th');

    headTimeCell.textContent = 'Time';
    headTypeCell.textContent = 'Type';
    headIpCell.textContent = 'IP';
    headDeviceCell.textContent = 'Device';

    headRow.append(headTimeCell, headTypeCell, headIpCell, headDeviceCell);
    activityTable.appendChild(headRow);

    if (data.length < 1) {
        const dataRow = document.createElement('tr');
        const noDataMessage = document.createElement('td');
        noDataMessage.textContent = 'No records';
        noDataMessage.setAttribute('colspan', '4');
        noDataMessage.classList.add('text-center');
        dataRow.appendChild(noDataMessage);
        dataRows.push(dataRow);
    } else {
        data.forEach(item => {
            let dataRow = document.createElement('tr');

            let timeCell = document.createElement('td');
            let typeCell = document.createElement('td');
            let ipCell = document.createElement('td');
            let deviceCell = document.createElement('td');

            timeCell.textContent = item.created_at;
            typeCell.textContent = item.description;
            ipCell.textContent = item.properties.IP;
            deviceCell.textContent = item.properties.UserAgent;

            dataRow.append(timeCell, typeCell, ipCell, deviceCell);
            dataRows.push(dataRow);
        });

    }
    activityTable.append(...dataRows);
    return activityTable;
}

const updateUnreviewedComplainsCount = (badges) => {
    axios.get('/api/admin/count_unreviewed_complains')
        .then(function (response) {
            helpers.updateBadges(badges, response.data.count);
        })
        .catch(function (error) {
            console.log(error);
        })
}

const unreviewedComplainsBadges = document.querySelectorAll('.unreviewed-complains-badge');
if (unreviewedComplainsBadges.length !== 0) {
    updateUnreviewedComplainsCount(unreviewedComplainsBadges);
    window.setInterval(() => { updateUnreviewedComplainsCount(unreviewedComplainsBadges) }, 60000);
}
