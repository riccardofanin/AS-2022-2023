var seatingChart = document.getElementById('seating-chart');
var seatSelected = [];

function generateSeats()
{
    for (let i = 0; i < 6; i++) {
        document.getElementById('seating-chart').innerHTML += "<div class='flex mb-4'>";
        for(let j = 0; j<11; j++)
        {
            document.getElementById('seating-chart').innerHTML += "<div id='r" + i + "-c" + j + "' class='seat text-center'></div>";
        }
        document.getElementById('seating-chart').innerHTML += "</div>";
    }

    var count = 1;
    Array.from(document.getElementsByClassName('seat')).forEach(element => {
        if(count < 10)
        {
            element.innerHTML = '0' + count++;
        }
        else
        {
            element.innerHTML = count++;
        }
    });


}

generateSeats();


seatingChart.addEventListener('click', function(event) {
    if (event.target.classList.contains('seat')) {
        if(event.target.classList.contains('selected'))
        {
            for (let i = 0; i < seatSelected.length; i++) {
                if(seatSelected[i] == event.target.id)
                    seatSelected.splice(i, 1);
            }

            let str = document.getElementById('seat-list').innerHTML;
            str = str.replace(str.slice(str.length - 4, str.length), "");
            document.getElementById('seat-list').innerHTML = str;

            event.target.classList.remove('selected');
        }
        else
        {
            document.getElementById('seat-list').innerHTML += event.target.innerHTML + ', ';
            seatSelected.push(event.target.id);
            event.target.classList.toggle('selected');
        }

    }
    console.log(seatSelected);
});

$('#sas').click(function() {
    $.ajax({
        type: "POST",
        url: "prenotazioni.php",
        data: { 
            seat: seatSelected
        }
    }).done(function( msg ) {
        alert( "Data Saved: " + msg );
    });
});
