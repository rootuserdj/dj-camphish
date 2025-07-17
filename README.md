#📷 CAM CAPTURE & STEALTH REDIRECT SYSTEM

Author: Dhananjay Sah

Explored & Refined from: TechChip CamPhish (Open Source)

#📄 PROJECT OVERVIEW

This project enables **stealth in-browser webcam capture** using camera APIs,
automatically saving snapshots to your server, and seamlessly redirecting
the user to a specified URL post-capture.

It is designed for:
✅ Ethical hacking labs
✅ OSINT workflow demonstrations
✅ Privacy awareness training
✅ Red team controlled environment testing

#📂 PROJECT STRUCTURE
/
├── index.html         → Minimal capture page with loader animation
├── capture.js         → Handles camera stream, image capture, auto-redirect
├── save.php           → Receives & saves captured images
├── redirect.txt       → Holds your redirect URL
└── /captures/         → Stores victim images securely

#🚀 HOW IT WORKS

✅ User opens `index.html` (locally or on your hosted server).
✅ Camera permission prompt appears, and if allowed:
   - Camera activates silently in the background.
✅ Captures **2 images** at 1.5-second intervals.
✅ Sends images to `save.php`, which saves them under `/captures/`.
✅ After capture, reads `redirect.txt` and redirects user automatically.

#⚙️ USAGE INSTRUCTIONS

1️⃣ **Requirements:**
   - PHP-enabled hosting (local Apache, XAMPP, cPanel, VPS).
   - Internet connection if remote capture is intended.
   - A device with a camera.

2️⃣ **Setup:**
   - Upload all files to your server.
   - Create a `captures/` folder with write permissions:
     (Linux: `chmod 777 captures`, or set writable via cPanel).
   - Place your desired redirect URL inside `redirect.txt`.

3️⃣ **Execution:**
   - Share or open `index.html` on the target device.
   - Wait for 2 images to be captured automatically.
   - User will be redirected to the URL specified in `redirect.txt`.
   - Retrieve captured images from `/captures/` for analysis.

#💡 ADVANCED CONFIGURATION

✔ **Change Capture Count:**
   - Edit `const maxCaptures` in `capture.js`.

✔ **Adjust Interval:**
   - Modify the interval (ms) inside `setInterval()` in `capture.js`.

✔ **Image Quality:**
   - Tweak `canvas.toDataURL()` settings for quality adjustments.

✔ **IP/User-Agent Logging:**
   - Extend `save.php` to log IP address, timestamp, and User-Agent
     for advanced operational tracking.

#⚠️ LEGAL DISCLAIMER

This tool is provided strictly for:
✅ Educational cybersecurity training
✅ Awareness demonstrations
✅ Controlled red team environments

⚠️ **You must have explicit consent before capturing images.**
⚠️ Unauthorized use against individuals or systems may violate privacy laws
   and is punishable under local and international regulations.

**Use responsibly and ethically.**

#📞 CONTACT

👤 Dhananjay Sah  
📱 +977 9824204425  
📧 rootuserdj@gmail.com

For collaboration, queries, or workshop demonstrations,
feel free to reach out anytime.

=============================================================
