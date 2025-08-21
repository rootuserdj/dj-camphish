
## About dj-camphish

`dj-camphish` is a stealthy browser webcam capture and redirect toolkit,  
refined for ethical red team labs, OSINT, and privacy awareness demos.

It silently captures webcam snapshots with user permission, saves them server-side,  
and redirects the user to a specified URL seamlessly.

---

## Features

- 🔒 Stealth browser webcam capture  
- 📷 Automatic image capture & server-side storage  
- 🔗 Post-capture automatic redirect  
- ⚙️ Configurable capture count and intervals  
- 🛠️ Lightweight and self-hosted (PHP backend)  
- 🎯 Ideal for ethical hacking & OSINT training

---

## Project Structure

index.html         # Capture page with loader

capture.js         # Handles webcam and image capture

save.php           # Server-side image save handler

redirect.txt       # Target URL after capture

/captures/         # Stores captured images

admin.php         # Admin Panel 

---

## Setup & Usage

1. Ensure PHP-enabled hosting (localhost, VPS, cPanel).  
2. Upload files and create `/captures/` with write permissions.  
3. Go to admin Panel `yourdomain.com/admin.php`.  
4. Share the `index.html` URL.  
5. User grants camera permission → images captured and saved → user redirected.

---

## Configuration

- Modify capture count in `capture.js` (`maxCaptures` variable).  
- Change capture interval in `capture.js` (`setInterval` timing).  
- Update redirect URL via `Admin Pannel`.  
- Extend `save.php` for advanced logging (IP, User-Agent).

---

## Legal Notice

**Use responsibly. This tool is for educational and ethical purposes only.**  
Unauthorized use may violate privacy laws. Obtain explicit consent before use.

---

## Contact

**Dhananjay Sah**  
📞 +977 9824204425  
✉️ rootuserdj@gmail.com

---

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

⭐ If you find this useful, please ⭐  
[Star the repo!](https://github.com/dhananjay-sah/dj-camphish/stargazers)

---

*Thank you for visiting!* 🙏
