from openai import OpenAI
import os
import openai
client = OpenAI(
  api_key=os.environ['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'],  # this is also the default, it can be omitted
)
def call_openai(prompt):
    response = openai.Completion.create(
        engine="text-davinci-002",
        prompt=prompt,
        max_tokens=150,
        temperature=0.7,
        top_p=1,
        n=1,
        stop=['\n', '###']
    )
    return response.choices[0].text.strip()

# Example prompt
prompt = "Once upon a time,"

# Call the OpenAI API
response = call_openai(prompt)

# Print the response
print(response)
