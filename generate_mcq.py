import sys
import json
import re
from groq import Groq

def generate_mcqs(num_questions, topic, difficulty):
    client = Groq(api_key="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")
    completion = client.chat.completions.create(
        model="llama3-8b-8192",
        messages=[
            {
                "role": "user",
                "content": f"Generate me {num_questions} MCQ questions on the topic of {topic} with a difficulty level of {difficulty}. Return the output in JSON format."
            }
        ],
        temperature=1,
        max_tokens=1024,
        top_p=1,
        stream=True,
        stop=None,
    )

    response_text = ""

    for chunk in completion:
        response_text += chunk.choices[0].delta.content or ""

    json_match = re.search(r'\[\s*\{.*\}\s*\]', response_text, re.DOTALL)

    if not json_match:
        return json.dumps({"error": "Failed to extract JSON"})

    json_data = json_match.group(0)

    try:
        questions_list = json.loads(json_data)
        return json.dumps(questions_list)
    except json.JSONDecodeError:
        return json.dumps({"error": "Failed to decode JSON"})

if __name__ == "__main__":
    num_questions = sys.argv[1]
    topic = sys.argv[2]
    difficulty = sys.argv[3]

    questions_json = generate_mcqs(num_questions, topic, difficulty)
    print(questions_json)