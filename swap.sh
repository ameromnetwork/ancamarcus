df -h 
dd if=/dev/zero of=/swapfile bs=1M count=1024
sudo dd if=/dev/zero of=/swapfile bs=1M count=1024
mkswap /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
echo 'echo "/swapfile  none  swap  defaults  0  0" >> /etc/fstab' | sudo sh

free -m
