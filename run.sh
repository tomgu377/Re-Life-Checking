#!/bin/bash

folder="list"

while true
do
    # Cek apakah ada file dengan ekstensi .txt di dalam folder
    if compgen -G "$folder/*.txt" > /dev/null; then
        # Jika ada file .txt, jalankan program PHP tanpa argumen file
        php index.php
    else
        # Jika tidak ada file .txt, hentikan script
        php index.php
        echo "[!] Tidak ada file .txt di dalam folder $folder. Re-Life Checking dihentikan."
        break
    fi

    echo "Restarting program..."
    sleep 1 # Jeda sejenak sebelum restart
done
