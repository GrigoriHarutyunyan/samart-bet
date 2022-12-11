window.addEventListener('DOMContentLoaded', (event) => {
    const configForm = document.getElementById('config-form')
    const lotteryTableEl = document.getElementById('lottery-table')
    let formEntries

    handleConfigForm()
    handlePlayGameForm()

    function handlePlayGameForm() {
        document.getElementById('play-game-form').addEventListener('submit', function (e) {
            e.preventDefault()
            const userBalls = Array.from(lotteryTableEl.querySelectorAll('td.selected')).map(function (item) {
                return item.textContent
            })
            formEntries['user-balls'] = userBalls.toString()

            for (const key in formEntries) {
                if (formEntries.hasOwnProperty(key)) {

                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = key;
                    hiddenField.value = formEntries[key];

                    e.target.appendChild(hiddenField);
                }
            }

            document.body.appendChild(e.target);
            e.target.submit();
        }, false)
    }

    function handleConfigForm() {
        const playBtn = document.getElementsByClassName('btn__play')[0]
        const lotteryTableChildLength = document.getElementById('lottery-table').childNodes.length
        if (!playBtn) return false

        configForm.addEventListener('submit', function (e) {
            e.preventDefault()
            const formData = new FormData(configForm)
            formEntries = Object.fromEntries(formData.entries())

            if ( lotteryTableChildLength == 0) {
                drawUserBallsTable(e.target)
            }

            lotteryTableEl.querySelectorAll('td').forEach(function (item) {
                item.addEventListener('click', function (e) {
                    if (lotteryTableEl.querySelectorAll('td.selected').length + 1 <= parseInt(formEntries['lotto-config']) || e.target.classList.contains('selected')) {
                        e.target.classList.toggle('selected')
                    }

                    if (lotteryTableEl.querySelectorAll('td.selected').length >= parseInt(formEntries['lotto-config'])) {
                        playBtn.removeAttribute('disabled')
                    } else {
                        playBtn.setAttribute('disabled', 'disabled')
                    }
                }, false)
            })
        })
    }

    function drawUserBallsTable(targetEl) {

        if ((formEntries['machine-balls'] == 40 || formEntries['machine-balls'] == 49) && (formEntries['lotto-config'] == 5 || formEntries['lotto-config'] == 7)) {
            document.getElementsByClassName('error-message')[0].style.display = 'none';
            const rowCount = Math.floor(formEntries['machine-balls'] / 7)
            const collCount = Math.floor(formEntries['machine-balls'] / rowCount)

            let tableStr = '<tbody>'
            let k = 0
            for (let i = 0; i < rowCount; i++) {
                tableStr += "<tr>"
                for (let j = 0; j < collCount; j++) {
                    ++k
                    tableStr += `<td>${k}</td>`
                }
                tableStr += "</tr>";
            }

            tableStr += '<tbody>'
            const newTableEl = document.createElement('table');
            newTableEl.innerHTML = tableStr

            targetEl.querySelector(".btn[type='submit']").setAttribute('disabled', 'disabled');
            document.getElementById('lottery-table').appendChild(newTableEl);
        } else {
            document.getElementsByClassName('error-message')[0].style.display = 'block';
        }
    }
});
