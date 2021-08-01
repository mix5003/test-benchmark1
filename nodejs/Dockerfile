FROM node:14

WORKDIR /usr/src/app
ENV NODE_ENV=production

RUN npm install -g pm2 
# Install app dependencies
# A wildcard is used to ensure both package.json AND package-lock.json are copied
# where available (npm@5+)
COPY package*.json ./

RUN npm install

COPY . .

EXPOSE 3000

CMD [ "pm2-runtime", "-i", "8", "app.js" ]
