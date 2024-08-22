from django.db import models

# Create your models here.
from django.db import models

class Sensor(models.Model):
    temp = models.IntegerField()
    humi = models.IntegerField()
    date = models.DateField()

    def __str__(self):
        return f"{self.date}: Temp={self.temp}, Humi={self.humi}"
