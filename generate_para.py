import sys
import json
import re
from groq import Groq

number = int(sys.argv[1])
paragraph = sys.argv[2]

client = Groq(api_key="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")
completion = client.chat.completions.create(
    model="llama3-8b-8192",
    messages=[
        {
            "role": "user",
            "content": f"Generate {number} questions that are not MCQs but there are simple one line questions from this paragraph \"{paragraph}\" Give me the output in JSON format"
        }
    ],
    temperature=1,
    max_tokens=1024,
    top_p=1,
    stream=True,
    stop=None,
)

response_data = ""
for chunk in completion:
    response_data += chunk.choices[0].delta.content or ""

json_match = re.search(r'(\[.*\])', response_data, re.DOTALL)
if json_match:
    json_data = json_match.group(1)
    try:
        questions_json = json.loads(json_data)
    except json.JSONDecodeError:
        print("Error decoding JSON response")
        sys.exit(1)
else:
    print("No valid JSON content found")
    sys.exit(1)
questions = [q['question'] for q in questions_json]
for i, question in enumerate(questions, start=1):
    print(f"{i}. {question}")
