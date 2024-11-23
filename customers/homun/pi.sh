sudo apt update && sudo apt upgrade -y && sudo apt install vim git screen -y
sudo mkdir /ris && cd /ris
sudo chown -R "$(whoami)":"$(whoami)" /ris
cd /ris
git config --global credential.helper cache
git clone https://github.com/root-it-solutions/env.git
cp /ris/env/.bashrc_pi ~/.bashrc && cp /ris/env/.vimrc ~/ && cp -R /ris/env/.ssh ~/
source ~/.bashrc
sudo cp /ris/env/.bashrc_root /root/.bashrc && sudo cp /ris/env/.vimrc /root/ && sudo mkdir /root/.vim
