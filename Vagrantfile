Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/bionic64"
  config.vm.network "private_network", ip: "192.168.33.20"
  config.vm.synced_folder "../Alam/", "/var/www/html", "mount_options" => ['dmode = 777', 'fmode = 777']
  config.vm.provider "virtualbox" do |vb|
     vb.gui = true
  end
end