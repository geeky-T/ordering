
crontab -l > rentChargeCron
#echo new cron into cron file
echo "0 0-23 * * * cd ${1} && php artisan schedule:run 1>> ${1}/storage/logs/scheduler.log 2>&1" >> rentChargeCron
#install new cron file
crontab rentChargeCron
rm rentChargeCron
