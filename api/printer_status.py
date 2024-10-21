import subprocess
import sys
from bs4 import BeautifulSoup
import json

# Step 1: Get the IP address from the command line arguments
if len(sys.argv) < 2:
    print(json.dumps({"error": "No IP address provided"}))
    sys.exit(1)

ip_address = sys.argv[1]

# Step 2: Use subprocess to call curl with HTTP/0.9 to get the HTML content
curl_command = ["curl", "--silent", "--http0.9", f"http://{ip_address}/prt_status.htm"]

try:
    # Adding a timeout of 5 seconds
    result = subprocess.run(curl_command, stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True, timeout=5)
    html_content = result.stdout

except subprocess.TimeoutExpired:
    print(json.dumps({"error": "Request timed out"}))
    sys.exit(1)

except Exception as e:
    print(json.dumps({"error": "Failed to fetch the printer status"}))
    sys.exit(1)

# Step 3: Parse the HTML using BeautifulSoup
soup = BeautifulSoup(html_content, 'html.parser')

# Step 4: Extract the relevant printer status data
tables = soup.find_all('table')

if len(tables) < 2:
    print(json.dumps({"error": "Unable to find printer status table"}))
    sys.exit(1)

status_table = tables[1].find_all('table')[0]
rows = status_table.find_all('tr')

# Step 5: Extract data from the table
data = {}
for row in rows:
    cols = row.find_all('td')
    if len(cols) == 2:
        key = cols[0].text.strip()
        value = cols[1].text.strip()
        data[key] = value

# Step 6: Convert the extracted data to JSON and print only the JSON
json_data = json.dumps(data, indent=4)
print(json_data)
