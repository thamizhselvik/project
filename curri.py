import sys
from groq import Groq

topic = sys.argv[1]
client = Groq(api_key="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")

completion = client.chat.completions.create(
    model="llama3-8b-8192",
    messages=[
        {
            "role": "user",
            "content": f"Generate a curriculum for the subject \"{topic}\" and give output in JSON format."
        }
    ],
    temperature=1,
    max_tokens=1024,
    top_p=1,
    stream=True,
    stop=None,
)

for chunk in completion:
    print(chunk.choices[0].delta.content or "", end="")
