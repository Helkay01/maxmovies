const puppeteer = require("puppeteer");

(async () => {
  const browser = await puppeteer.launch({
    headless: "new",
    args: [
        "--no-sandbox",
      "--disable-setuid-sandbox",
      "--disable-dev-shm-usage",
      "--single-process"
      
    ]  });

  const page = await browser.newPage();

  await page.goto("https://proxydb.net/?protocol=socks5&anonlvl=4", {
    waitUntil: "networkidle2",
    timeout: 0
  });

  const data = await page.evaluate(() => {
    const rows = Array.from(document.querySelectorAll("tbody tr"));
    return rows.map(row => {
      const ip = row.querySelector("td:nth-child(1)")?.innerText.trim();
      const port = row.querySelector("td:nth-child(2) a")?.innerText.trim();
      return { ip, port };
    }).filter(item => item.ip && item.port);
  });

  console.log(JSON.stringify(data, null, 2));

  await browser.close();
})();
