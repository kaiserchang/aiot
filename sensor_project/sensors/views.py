from django.shortcuts import render

# Create your views here.
from django.shortcuts import render
from .models import Sensor

def sensor_chart(request):
    sensors = Sensor.objects.order_by('date')
    temps = [sensor.temp for sensor in sensors]
    humis = [sensor.humi for sensor in sensors]
    indices = list(range(1, len(sensors) + 1))

    return render(request, 'sensor_chart.html', {
        'temps': temps,
        'humis': humis,
        'indices': indices,
    })
