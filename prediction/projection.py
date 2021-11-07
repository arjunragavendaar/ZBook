import csv
import sys
import pandas as pd
import matplotlib
import matplotlib.pyplot as plt
import seaborn as sns
from wordcloud import WordCloud, STOPWORDS
df = pd.read_csv('C:/Users/amirthaa/Desktop/ZBook/dataset/zomato.csv',engine='python')


nan_values = df.isna()
nan_columns = nan_values.any()

columns_with_nan = df.columns[nan_columns].tolist()

sns.set_style('darkgrid')
matplotlib.rcParams['font.size'] = 14
matplotlib.rcParams['figure.figsize'] = (9, 5)
matplotlib.rcParams['figure.facecolor'] = '#00000000'

plt.figure(figsize=(12,6))
# plt.xticks(rotation=75)
plt.title('Rating Color')
sns.barplot(x=df['Rating color'], y=df['Votes'])

plt.figure(figsize=(12,6))
plt.title('Distribution')
plt.pie(df['Has Online delivery'].value_counts()/9551*100, labels=df['Has Online delivery'].value_counts().index, autopct='%1.1f%%', startangle=180);


city = df[(df.City == sys.argv[1])]
plt.figure(figsize=(12,6))
sns.barplot(x=city.Locality.value_counts().head(10), y=city.Locality.value_counts().head(10).index)

plt.ylabel(None);


ConnaughtPlace = city[(city.Locality.isin(['Connaught Place'])) & (city['Rating text'].isin(['Excellent','Very Good']))]

ConnaughtPlace = ConnaughtPlace.Cuisines.value_counts().reset_index()


cuisien = []
for x in ConnaughtPlace['index']:
  cuisien.append(x)



comment_words = ''
stopwords = set(STOPWORDS)


for val in cuisien:

    # typecaste each val to string
    val = str(val)

    # split the value
    tokens = val.split()

    # Converts each token into lowercase
    for i in range(len(tokens)):
        tokens[i] = tokens[i].lower()

    comment_words += " ".join(tokens) + " "

wordcloud = WordCloud(width=800, height=800,
                      background_color='white',
                      stopwords=stopwords,
                      min_font_size=10).generate(comment_words)

# plot the WordCloud image
plt.figure(figsize=(8, 8), facecolor='b', edgecolor='g')
plt.imshow(wordcloud)
plt.axis("off")
plt.tight_layout(pad=0)

plt.show()


