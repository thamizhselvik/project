import sys
import json
from groq import Groq

number = sys.argv[1]
topic = sys.argv[2]
difficulty = sys.argv[3]

client = Groq(api_key="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")
try:
    completion = client.chat.completions.create(
        model="llama3-8b-8192",
        messages=[
            {
                "role": "user",
                "content": f"Generate {number} coding questions in {topic} on {difficulty} level. Return only the question in one line. Return the output as JSON format."
            }
        ],
        max_tokens=2048,
        temperature=0.7,
    )
    choices = completion.choices
    if choices and len(choices) > 0:
        content = choices[0].message.content

        start = content.find('[')
        end = content.find(']') + 1

        if start != -1 and end != -1:
            questions_json = content[start:end]
            try:
                parsed_json = json.loads(questions_json)
                print(json.dumps(parsed_json))
            except json.JSONDecodeError:
                print("[]")
        else:
            print("[]")
    else:
        print("Error: No choices returned from the Groq API")

except Exception as e:
    print(f"Error: {e}")
