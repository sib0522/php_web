import json
import csv
import os

for filename in os.listdir('.'):
    if filename.endswith('.csv'):
        base_name = os.path.splitext(filename)[0]
        json_file = f"./{base_name}.json"

        with open(filename, 'r', encoding='utf-8') as csv_file:
            reader = csv.DictReader(csv_file)
            data = list(reader)

        with open(json_file, 'w', encoding='utf-8') as json_file_handle:
            json.dump(data, json_file_handle, ensure_ascii=False, indent=4)

        print(f"success: {filename} -> {json_file}")    
    