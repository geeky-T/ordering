
crontab -l > rentChargeCron
#echo new cron into cron file
echo "* * * * * cd ${1} && php artisan schedule:run 1>> ./logs/scheduler.log 2>&1" >> rentChargeCron
#install new cron file
crontab rentChargeCron
rm rentChargeCron
