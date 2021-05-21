<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <h4 class="text-center">Pruebas</h4>
    <table class="table mt-4">
      <thead>
        <tr class="text-center">
          <th scope="col">Temperatura</th>
          <th scope="col">Humedad</th>
          <th scope="col">Fecha</th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>

    <div class="card my-4">
      <div class="card-header">Gráfica de temperatura</div>
      <div class="card-body">
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>
    </div>

    <div class="card my-4">
      <div class="card-header">Gráfica de temperatura</div>
      <div class="card-body">
        <canvas id="myChart2" width="400" height="400"></canvas>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.1/chart.min.js" integrity="sha512-tOcHADT+YGCQqH7YO99uJdko6L8Qk5oudLN6sCeI4BQnpENq6riR6x9Im+SGzhXpgooKBRkPsget4EOoH5jNCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    var ctx = document.getElementById('myChart').getContext('2d');

    let data = {
          label: 'Temperatura',
          data: [],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [data]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    var ctx2 = document.getElementById('myChart2').getContext('2d');

    let data2 = {
          label: 'Humedad',
          data: [],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }

    var myChart2 = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: [],
        datasets: [data2]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    fetch('query.php')
      .then(r => r.json())
      .then(r => {
        const tbody = document.getElementById('tbody');
        let template = '';

        // console.log(r)

        r.map(item => {
          myChart.data.labels.push(item.fecha);
          data.data.push(item.temp);
          myChart2.data.labels.push(item.fecha);
          data2.data.push(item.hum);
          template += `<tr class="text-center">
                        <td>${item.temp} °F</td>
                        <td>${item.hum} %</td>
                        <td>${item.fecha}</td>
                       </tr>`;
        });

        tbody.innerHTML = template;
        myChart.update();
        myChart2.update();

      })
      .catch(err => console.error(err));
  </script>
</body>

</html>